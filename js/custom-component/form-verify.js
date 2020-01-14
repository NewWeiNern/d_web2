class Verify{
    constructor(){
    }
    static validate(e){
        e.preventDefault();  
        let target = e.target,
        obj = {};

        for(let i = 0; i < target.length; i++){
            if(target[i].type === "radio" && target[i].checked){
                obj[target[i].name] = target[i].value;
            }else{
                if(target[i].type != "radio"){
                    obj[target[i].name] = target[i].value;
                }
            }
            
        }

        $.ajax({
            url : "res/user_verify.php",
            method : "POST",
            data : obj
        }).done(function(ea){
            let msg = JSON.parse(ea);
            if(msg.res == 0){
                if(msg.err === 0){
                    modal.toggleModal(e);
                }
                
            }
            else{
                document.createElement('form').submit.call(target);
            }
        });
    }
}