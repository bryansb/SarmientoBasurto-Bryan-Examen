function createTicket(evt){
    evt.preventDefault();
    var form = document.forms.namedItem("f_ticket");
    var formData = new FormData(form);
    
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) {
            var e = document.getElementById("notice");
            e.innerHTML = this.responseText;
            document.getElementById("main_notice").classList.remove("e_hidden");
        } 
    };
    xmlhttp.open("POST","controller/create_ticket.php", true); 
    xmlhttp.send(formData);

    return false;
}

function filterUsers(evt){
    evt.preventDefault();
    var form = document.forms.namedItem("f_filter_data");
    var formData = new FormData(form);

    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("user_data").innerHTML = this.responseText;
        } 
    };
    xmlhttp.open("POST","controller/search_client.php", true); 
    xmlhttp.send(formData);

    return false;
}

function filterTickets(evt){
    evt.preventDefault();
    var form = document.forms.namedItem("f_filter_data");
    var formData = new FormData(form);

    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() { 
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("user_data").innerHTML = this.responseText;
        } 
    };
    xmlhttp.open("POST","controller/search_client.php", true); 
    xmlhttp.send(formData);

    return false;
}