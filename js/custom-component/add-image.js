$(document).ready(function(){
    $("#image").on("change", function(e){
        const img =e.target.files[0],
        reader = new FileReader(),
        img_ele = $(".img");
        reader.readAsDataURL(img);
        reader.onload = e=>{
            img_ele.css("backgroundImage", `url(${e.target.result})`);
        }
    });
});