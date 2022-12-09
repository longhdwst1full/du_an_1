const iconClick = document.querySelector('.menuShowIcon');
const menuNav = document.querySelector('.navigationColumn');
const canHidden = document.querySelectorAll('.canHidden');
const titlePageAdmin = document.querySelector('.titlePageAdmin');
const nameAdmin = document.querySelector('.nameAdmin--navLeft');
const titleList = document.querySelector('.titleList');
const hiddenImage = document.querySelector('.hiddenImage');
const logoBrand = document.querySelector('.logoBrand');
const spaceLogoBrand = document.querySelector('.spaceLogoBrand');
const liMenu = document.querySelectorAll('.navigationListFisrt ul li');
const logoLiMenu = document.querySelectorAll('.navigationListFisrt ul li a i.fa-solid');
const logoLiMenuBrand = document.querySelectorAll('.navigationListFisrt ul li a i.fa-brands')[0];
// console.log(canHidden);

let flag = 0;
let respon = sessionStorage.getItem('hiddenMenu');
if (respon !== "hidden") {
    menuNav.style.width = "15%";
    titlePageAdmin.style.width = "15%";
    // menuNav.style.transition = "all 0.3s linear";
    // titlePageAdmin.style.transition = "all 0.3s linear";
    spaceLogoBrand.style.width = "calc(100% - 15%)";
    nameAdmin.style.display = "block";
    titleList.style.display = "block";
    document.querySelector('.listMainFirst .titleList h2').style.transform = "translateX(0%)";
    // titleList.style.transition = "all 0.3s linear";
    hiddenImage.style.display = "block";
    document.querySelector('.contentManager').style.left = "310px";
    // document.querySelector('.contentManager').style.transition = "all 0.3s linear";
    canHidden.forEach(function(item) {
        item.style.display = "block";
        liMenu.forEach(function(itemLi) {
            itemLi.style.display = "flex";
        });
        logoLiMenu.forEach(function(itemLogo) {
            itemLogo.style.fontSize = "22px";
        })
    });
    logoLiMenuBrand.style.fontSize = "22px";
    document.querySelector('.accountAdmin--canHidden').style.display = "flex";
    document.querySelector('.accountAdmin--canHidden').style.padding = "20px 0 20px 20px";
} else {
    menuNav.style.width = "5.6%";
    titlePageAdmin.style.width = "5.5%";
    // menuNav.style.transition = "all 0.3s linear";
    // titlePageAdmin.style.transition = "all 0.3s linear";
    spaceLogoBrand.style.width = "calc(100% - 5.5%)";
    nameAdmin.style.display = "none";
    titleList.style.display = "none";
    document.querySelector('.listMainFirst .titleList h2').style.transform = "translateX(-100%)";
    hiddenImage.style.display = "none";
    document.querySelector('.contentManager').style.left = "130px";
    // document.querySelector('.contentManager').style.transition = "all 0.3s linear";
    canHidden.forEach(function(item) {
        item.style.display = "none";
        liMenu.forEach(function(itemLi) {
            itemLi.style.display = "block";
            itemLi.style.textAlign = "center";
        });
        logoLiMenu.forEach(function(itemLogo) {
            itemLogo.style.fontSize = "28px";
        })
    });
    logoLiMenuBrand.style.fontSize = "28px";
    document.querySelector('.accountAdmin--canHidden').style.display = "block";
    document.querySelector('.accountAdmin--canHidden').style.padding = "20px 0 20px 0";
    document.querySelector('.accountAdmin--canHidden').style.textAlign = "center";
}
iconClick.addEventListener('click', function() {
    flag++;
    if (flag % 2 != 0) {
        sessionStorage.setItem("hiddenMenu", "hidden");
        menuNav.style.width = "5.6%";
        titlePageAdmin.style.width = "5.5%";
        // menuNav.style.transition = "all 0.3s linear";
        // titlePageAdmin.style.transition = "all 0.3s linear";
        spaceLogoBrand.style.width = "calc(100% - 5.5%)";
        nameAdmin.style.display = "none";
        titleList.style.display = "none";
        document.querySelector('.listMainFirst .titleList h2').style.transform = "translateX(-100%)";
        hiddenImage.style.display = "none";
        document.querySelector('.contentManager').style.left = "130px";
        // document.querySelector('.contentManager').style.transition = "all 0.3s linear";
        canHidden.forEach(function(item) {
            item.style.display = "none";
            liMenu.forEach(function(itemLi) {
                itemLi.style.display = "block";
                itemLi.style.textAlign = "center";
            });
            logoLiMenu.forEach(function(itemLogo) {
                itemLogo.style.fontSize = "28px";
            })
        });
        logoLiMenuBrand.style.fontSize = "28px";
        document.querySelector('.accountAdmin--canHidden').style.display = "block";
        document.querySelector('.accountAdmin--canHidden').style.padding = "20px 0 20px 0";
        document.querySelector('.accountAdmin--canHidden').style.textAlign = "center";
    } else {
        sessionStorage.removeItem('hiddenMenu');
        menuNav.style.width = "15%";
        titlePageAdmin.style.width = "15%";
        // menuNav.style.transition = "all 0.3s linear";
        // titlePageAdmin.style.transition = "all 0.3s linear";
        spaceLogoBrand.style.width = "calc(100% - 15%)";
        nameAdmin.style.display = "block";
        titleList.style.display = "block";
        document.querySelector('.listMainFirst .titleList h2').style.transform = "translateX(0%)";
        // titleList.style.transition = "all 0.3s linear";
        hiddenImage.style.display = "block";
        document.querySelector('.contentManager').style.left = "310px";
        // document.querySelector('.contentManager').style.transition = "all 0.3s linear";
        canHidden.forEach(function(item) {
            item.style.display = "block";
            liMenu.forEach(function(itemLi) {
                itemLi.style.display = "flex";
            });
            logoLiMenu.forEach(function(itemLogo) {
                itemLogo.style.fontSize = "22px";
            })
        });
        logoLiMenuBrand.style.fontSize = "22px";
        document.querySelector('.accountAdmin--canHidden').style.display = "flex";
        document.querySelector('.accountAdmin--canHidden').style.padding = "20px 0 20px 20px";
    }
});
const logoRespon = document.querySelectorAll('.navigationListFisrt ul li a:first-child');