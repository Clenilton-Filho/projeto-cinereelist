function sideMenu(){
    $sideMenu = document.getElementById('side-menu');

    if ($sideMenu.style.left == '0%'){
        $sideMenu.style.left = '-50%';
    }else{
        $sideMenu.style.left = '0%';
    }
}