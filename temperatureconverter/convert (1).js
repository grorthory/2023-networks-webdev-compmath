window.addEventListener("DOMContentLoaded", domLoaded);

function domLoaded() {
   // TODO: Complete the function
  const convertBtn = document.getElementById("convertButton");
  const cInput = document.getElementById("cInput");
  const fInput = document.getElementById("fInput");
  convertBtn.addEventListener("click", buttonClicked);
cInput.addEventListener("input", clearFInput);
fInput.addEventListener("input", clearCInput);
}

function clearFInput(){
  fInput.value="";
  console.log("clear  F input");
  }

function clearCInput(){
  cInput.value="";
  console.log("clear C input");
  }

function buttonClicked(){
  console.log("button clicked");
  let temp;
  // not sure if this boolean statement works
  if (fInput.value){
    updateImage(fInput.value);
    temp=convertFtoC(parseFloat(fInput.value));
    if (isNaN(temp)){
    document.getElementById("errorMessage").innerHTML=fInput.value + " is not a number";
  console.log("invalid");
  }else{
      document.getElementById("errorMessage").innerHTML="";
  }
}
  else{
    temp=convertCtoF(parseFloat(cInput.value));
    if (isNaN(temp)){
    document.getElementById("errorMessage").innerHTML=cInput.value + " is not a number";
  console.log("invalid");
  }else{
      document.getElementById("errorMessage").innerHTML="";
  }
    console.log("f after conversion: " + temp);
    updateImage(temp);
  }
}

function convertCtoF(degreesCelsius) {
  let temp;
   // TODO: Complete the function
  temp = degreesCelsius*9/5+32;
  fInput.value=temp;
  return temp;
}

function convertFtoC(degreesFahrenheit) {
   // TODO: Complete the function
  let temp;
  temp=(degreesFahrenheit-32)*5/9;
  cInput.value=temp;
  return temp;
}

function updateImage(degreesFahrenheit){
  if (degreesFahrenheit<32){
      document.getElementById("weatherImage").src="cold.png";
    }else if (32<degreesFahrenheit && degreesFahrenheit<=50){
      document.getElementById("weatherImage").src="cool.png";
    }
  else{
    document.getElementById("weatherImage").src="warm.png";
  }
}
