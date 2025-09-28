<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UserModel');
    }

    public function show(){
        $page = 1;
        if(isset($_GET['page']) && ! empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if(isset($_GET['q']) && ! empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;

        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['users'] = $all['records'];
        $total_rows = $all['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('tailwind');
        $this->pagination->initialize($total_rows, $records_per_page, $page, site_url('users/show').'?q='.$q);

        $data['page'] = $this->pagination->paginate();
        $this->call->view('show', $data);
    }

    public function create() {
        if($this->io->method() == 'post'){
            $lastname  = $this->io->post('last_name');
            $firstname = $this->io->post('first_name');
            $email     = $this->io->post('email');

            $data = array(
                'last_name'  => $lastname,
                'first_name' => $firstname,
                'email'      => $email
            );

            if($this->UserModel->insert($data)){
                // 🔥 Redirect to dashboard after success
                redirect(site_url('users/show'));
            } else {
                echo 'Something went wrong while inserting user.';
                var_dump($this->db->error());
            }
        } else {
            $this->call->view('create');
        }
    }

    public function update($id) {
        $data['user'] = $this->UserModel->find($id);
        if($this->io->method() == 'post'){
            $lastname  = $this->io->post('last_name');
            $firstname = $this->io->post('first_name');
            $email     = $this->io->post('email');

            $data = array(
                'last_name'  => $lastname,
                'first_name' => $firstname,
                'email'      => $email
            );

            if($this->UserModel->update($id, $data)){
                redirect(site_url('users/show'));
            } else {
                echo 'Something went wrong while updating user.';
                var_dump($this->db->error());
            }
        } else {
            $this->call->view('update', $data);
        }
    }

    public function delete($id){
        if($this->UserModel->delete($id)){
            redirect(site_url('users/show'));
        } else {
            echo 'Something went wrong while deleting user.';
            var_dump($this->db->error());
        }
    }
}
