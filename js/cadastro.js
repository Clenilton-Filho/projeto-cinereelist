function previewImagem(event) {
    const reader = new FileReader();
    const formIcon = document.getElementById("form-icon");
    const previewDaImagem = document.getElementById("imagem-preview");

    reader.onload = function() {
        previewDaImagem.src = reader.result;
        formIcon.style.display = "none";
        previewDaImagem.style.display = "block"
        previewDaImagem.style.opacity = "100%";
    };
    reader.readAsDataURL(event.target.files[0]);
}