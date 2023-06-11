
function openFareCalculator() {
document.getElementById("fareCalculator").style.display = "block";

}

function closeFareCalculator() {
document.getElementById("fareCalculator").style.display = "none";
}
function closeFareDetails() {
  document.getElementById("fareDetails").style.display = "none";
  document.getElementById("fareForm").reset();
  }


function calculator(){
 
let fare=0;
a=document.getElementById('cfrom').value;
b=document.getElementById('cto').value;
num=document.getElementById('tickets').value;
slot=document.getElementById('time-slot').value;
type=document.getElementById('ticket-type').value;
console.log(from)
console.log(to) 
console.log(num)
console.log(slot)
console.log(type)

if(type=="two-way"){
  num=num*2;
}
if(slot=="mrng"||slot=="nyt"){
    // multiply fare with 2
    num=num/2;
}
from=Number(a);
to=Number(b);

if(from==""||to==""||num==""||slot==""){
  alert("Please fill all the fields");
}
else if(from==to){
  if(from!=""&&to!=""){
    alert("From and to are same stations, please correct it !!!")
  }
}
else{
c=from-to
console.log(c)
if(c==1||c==-1){
  fare=num*10;

}
else if(c==2||c==-2||c==3||c==-3||c==4||c==-4){
  fare=num*20;
  
}
else if(c==5||c==-5||c==6||c==-6||c==7||c==-7){
  fare=num*30;
  
}
else if(c==8||c==-8||c==9||c==-9||c==10||c==-10||c==11||c==-11){
  fare=num*40;

}
else if(c==12||c==-12||c==13||c==-13||c==14||c==-14||c==15||c==-15||c==16||c==-16){
  fare=num*50;
  
}
else if(c==17||c==-17||c==18||c==-18||c==19||c==-19||c==20||c==-20||c==21||c==-21||c==22||c==-22||c==23||c==-23){
  fare=num*60;

}

document.getElementById("fareDetails").style.display = "block";
document.getElementById("details").innerHTML = "Your fare is "+fare+" ₹"  ;
document.getElementById("fareCalculator").style.display = "none";
  //reset the form

}
}

  