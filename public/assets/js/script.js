const menuIcon = document.querySelector("#menu-icon");
const burgerMenu = document.querySelector(".burgerMenu");
const closedMenu = document.querySelector("#closed-menu");


menuIcon.addEventListener("click",() => {
    if(burgerMenu.style.display == 'none' || burgerMenu.style.display == '') {
        burgerMenu.style.display = 'flex';
        menuIcon.style.display = 'inline-block';

        if(closedMenu.style.display == 'none' || closedMenu.style.display == '') {
            closedMenu.style.display = 'inline-block'

            closedMenu.addEventListener('click', () =>{
                closedMenu.style.display = 'none';
                burgerMenu.style.display = 'none';
            });

            document.addEventListener('click',(event) =>{
                if(burgerMenu.contains(event.target)){
                    closedMenu.style.display = 'none';
                    burgerMenu.style.display = 'none';
                }
            })
        

        }
        
        
    } else {
        burgerMenu.style.display = 'none';
    };

});

