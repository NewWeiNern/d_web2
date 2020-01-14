var modal;
function navToggle(e, t){
    let navBgToggle = function(e){
        if($(document).scrollTop() > 0){
            t.parents(".nav-cover").css("background", "white");}
        else
            t.parents(".nav-cover").css("background", "none");
    };
    $(e).click(()=>t.toggleClass("close"));
    $(document).on("scroll", navBgToggle);
    $(window).on("load", navBgToggle);
}
function modalToggle(e){
    modal = new Log_Modal();
    for(let i = 0; i < e.length; i++){
        $(e[i]).click((e)=>{modal.toggleModal(e)});
    }
}
function setPage(link){
    link = link.replace(document.head.baseURI,"");
    $(document.body).addClass(link.split("/")[0]);
}
function mobile_view(){
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || (("standalone" in window.navigator) &&
    !window.navigator.standalone)){
        // document.getElementById("xd").remove();
        document.body.classList.add("mobile");
    }else{
        document.body.classList.remove("mobile");
    }
}
window.onresize = ()=>mobile_view();
mobile_view();

navToggle($(".hamburger-menu"), $("nav > ul"));
modalToggle($("ul.sec-nav:not(.cli) a, section.intro input[type='submit'].btn"));
setPage(window.location.href); // can be done via php