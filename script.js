const textInput = document.getElementById('textInput');
const shiftInput = document.getElementById('shiftInput');
const modeSelect = document.getElementById('modeSelect');
const outputResult = document.getElementById('outputResult');
const processBtn = document.getElementById('processBtn');
const copyBtn = document.getElementById('copyBtn');
const swapBtn = document.getElementById('swapBtn');
const characterCount = document.getElementById('characterCount');
const resultMode = document.getElementById('resultMode');
let latestResult = '';

function normalizeShift(value) {
    const number = Number.parseInt(value, 10);
    return Number.isNaN(number) ? 0 : Math.min(25, Math.max(0, number));
}

function caesarCipher(text, shift, mode) {
    const direction = mode === 'decrypt' ? -1 : 1;
    return [...text].map((character) => {
        const code = character.charCodeAt(0);
        const isUppercase = code >= 65 && code <= 90;
        const isLowercase = code >= 97 && code <= 122;
        if (!isUppercase && !isLowercase) return character;
        const alphabetStart = isUppercase ? 65 : 97;
        return String.fromCharCode(((code - alphabetStart + direction * shift + 26) % 26) + alphabetStart);
    }).join('');
}

function updateCount() {
    const count = textInput.value.length;
    characterCount.textContent = `${count.toLocaleString()} character${count === 1 ? '' : 's'}`;
}

function processMessage() {
    const text = textInput.value;
    const shift = normalizeShift(shiftInput.value);
    shiftInput.value = shift;
    latestResult = caesarCipher(text, shift, modeSelect.value);
    outputResult.textContent = latestResult || 'Enter a message above to create a result.';
    outputResult.classList.toggle('empty', !latestResult);
    copyBtn.disabled = !latestResult;
    swapBtn.disabled = !latestResult;
    resultMode.textContent = latestResult ? `${modeSelect.value === 'encrypt' ? 'Encrypted' : 'Decrypted'} with key ${shift}` : 'Waiting for input';
}

textInput.addEventListener('input', updateCount);
processBtn.addEventListener('click', processMessage);
modeSelect.addEventListener('change', () => {
    document.getElementById('processLabel').textContent = `${modeSelect.value[0].toUpperCase()}${modeSelect.value.slice(1)} message`;
});
document.getElementById('decreaseShift').addEventListener('click', () => { shiftInput.value = normalizeShift(shiftInput.value) - 1 < 0 ? 25 : normalizeShift(shiftInput.value) - 1; });
document.getElementById('increaseShift').addEventListener('click', () => { shiftInput.value = (normalizeShift(shiftInput.value) + 1) % 26; });
document.getElementById('clearBtn').addEventListener('click', () => { textInput.value = ''; latestResult = ''; updateCount(); processMessage(); textInput.focus(); });
swapBtn.addEventListener('click', () => { textInput.value = latestResult; modeSelect.value = modeSelect.value === 'encrypt' ? 'decrypt' : 'encrypt'; modeSelect.dispatchEvent(new Event('change')); updateCount(); textInput.focus(); });
copyBtn.addEventListener('click', async () => { await navigator.clipboard.writeText(latestResult); copyBtn.textContent = 'Copied'; setTimeout(() => { copyBtn.textContent = 'Copy result'; }, 1400); });
textInput.addEventListener('keydown', (event) => { if ((event.ctrlKey || event.metaKey) && event.key === 'Enter') processMessage(); });
updateCount();