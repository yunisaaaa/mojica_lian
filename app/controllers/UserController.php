<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('UserModel');
    }

    public function show() {
        // 🔹 Pagination setup
        $limit = 5; // ilang users per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit ;

        // 🔹 Get users with pagination
        $data['users'] = $this->UserModel->getStudents($limit, $offset);

        // 🔹 Count total users
        $total_users = $this->UserModel->getStudentCount();
        $data['total_pages'] = ceil($total_users / $limit);
        $data['current_page'] = $page;

        $this->call->view('show', $data);
    }

    public function create() {
        if ($this->io->method() == 'post') {
            $lastname = $this->io->post('last_name');
            $firstname = $this->io->post('first_name');
            $email = $this->io->post('email');

            $data = array(
                'last_name' => $lastname,
                'first_name' => $firstname,
                'email' => $email
            );

            if ($this->UserModel->insert($data)) {
                redirect('users/show');
            } else {
                echo 'Something went wrong';
            }
        } else {
            $this->call->view('create');
        }
    }

    public function update($id) {
        $data['user'] = $this->UserModel->find($id);

        if ($this->io->method() == 'post') {
            $lastname = $this->io->post('last_name');
            $firstname = $this->io->post('first_name');
            $email = $this->io->post('email');

            $data = array(
                'last_name' => $lastname,
                'first_name' => $firstname,
                'email' => $email
            );

            if ($this->UserModel->update($id, $data)) {
                redirect('users/show');
            } else {
                echo 'Something went wrong';
            }
        } else {
            $this->call->view('update', $data);
        }
    }

    public function delete($id) {
        if ($this->UserModel->delete($id)) {
            redirect('users/show');
        } else {
            echo 'Something went wrong';
        }
    }
}
