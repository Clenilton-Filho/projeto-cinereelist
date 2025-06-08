const $colaboradores = document.querySelectorAll('.colaborador');

$colaboradores.forEach(colaborador => {
    colaborador.addEventListener('mouseenter', () => {
        colaborador.children[0].children[0].style.display = 'block';
    });
});

$colaboradores.forEach(colaborador => {
    colaborador.addEventListener('mouseleave', () => {
        colaborador.children[0].children[0].style.display = 'none';
    });
});
