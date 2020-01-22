class Setting{
    static send = false;
    constructor(){}
    static validate(e){
        let target = e.target,
        obj = {};

        for(let i = 0; i < target.length; i++){
            if(target[i].type !=="file"){
                obj[target[i].name] = target[i].value;
            }else{continue;}
        }
        if(!Setting.send){
            $.ajax({
                url : "res/setting_validate.php",
                method : "POST",
                data : obj
            }).done(function(e){
                let msg = JSON.parse(e);
                if(msg.res === 1){
                    if(!Setting.send){
                        Setting.send = true;
                        $(target).submit();
                    }
                }else{
                    let p = $(document.createElement("p")),
                    err = msg.error,
                    submit = target.querySelector("input[name='submit']");
                    p
                    .addClass("err-msg")
                    .css("width", "100%")
                    .text(err);

                    if(!$(submit.previousElementSibling).hasClass("err-msg")){
                        $(submit).before(p);
                    }else{
                        $(submit.previousElementSibling).text(err);
                    }
                }

            });
            return false;
        }else{
            $(target).find("input[type='submit']").click();
            return true;
        }
    }
}