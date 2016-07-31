var e1=document.getElementById('username');
var e2=document.getElementById('feedback');
e1.addEventListener('blur',function(e){

   check(5);

},false);

function check(e,minlength){
    
    if(e.value.length<minlength){
    	e2.innerText="should be more than 5";
    }

}