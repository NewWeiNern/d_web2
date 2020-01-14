class Rate{
    constructor(e){
        this.parent = e;
    }
    init(a, arr = []){
        for(let i = 0; i < a.length; i++){
            $(this.parent).append(this.generateRow(a[i], arr[i]));
        }
    }
    generateRow(name, sel){
        let rating = document.createElement("div");
        rating.classList.add("rating");
        rating.dataset.name = name;
        let a = $(rating).append(`
        <div class="review-container" data-name="${name}">
            <fieldset>
                <input type="radio" id="${name}5" name="${name}" value="5" />
                <label class = "full" for="${name}5" title="Awesome - 5 stars"></label>

                <input type="radio" id="${name}4half" name="${name}" value="4.5" />
                <label class="half" for="${name}4half" title="Pretty good - 4.5 stars"></label>

                <input type="radio" id="${name}4" name="${name}" value="4" />
                <label class = "full" for="${name}4" title="Pretty good - 4 stars"></label>

                <input type="radio" id="${name}3half" name="${name}" value="3.5" />
                <label class="half" for="${name}3half" title="Meh - 3.5 stars"></label>

                <input type="radio" id="${name}3" name="${name}" value="3" />
                <label class = "full" for="${name}3" title="Meh - 3 stars"></label>

                <input type="radio" id="${name}2half" name="${name}" value="2.5" />
                <label class="half" for="${name}2half" title="Kinda bad - 2.5 stars"></label>

                <input type="radio" id="${name}2" name="${name}" value="2" />
                <label class = "full" for="${name}2" title="Kinda bad - 2 stars"></label>

                <input type="radio" id="${name}1half" name="${name}" value="1.5" />
                <label class="half" for="${name}1half" title="Meh - 1.5 stars"></label>

                <input type="radio" id="${name}1" name="${name}" value="1" />
                <label class = "full" for="${name}1" title="Sucks big time - 1 star"></label>

                <input type="radio" id="${name}half" name="${name}" value="0.5" />
                <label class="half" for="${name}half" title="Sucks big time - 0.5 stars"></label>
            </fieldset>
        </div>
        `);
        if(sel)
            a.find("input[value='" + sel + "']").prop("checked", true);
        return a;
    }
}