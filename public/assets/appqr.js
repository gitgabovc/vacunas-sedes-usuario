const contenedorQR = document.getElementById('contenedorQR');
const formularioQR = document.getElementById('formularioQR');

const QR = new QRCode(contenedorQR);

formularioQR.addEventListener('submit', (e) => {
    e.preventDefault();
    QR.makeCode(formularioQR.codeqr.value);
});