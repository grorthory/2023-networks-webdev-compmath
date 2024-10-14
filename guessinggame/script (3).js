// Your solution goes here 
function playGuessingGame(numToGuess, totalGuesses=10){
  let i=0;
  let guessedNum;
  while (i<totalGuesses){
      if(isNaN(guessedNum)&& i>0){
        guessedNum=prompt("Please enter a number.");
      }
        else if (i == 0){
      guessedNum = prompt("Enter a number between 1 and 100.");
      i+=1;
    } else if (guessedNum<numToGuess){
      guessedNum = prompt(guessedNum + " is too small. Guess a larger number.");
          i+=1;
    } else {
      guessedNum = prompt(guessedNum + " is too large. Guess a smaller number.");
          i+=1;      
    }
    if (guessedNum == undefined){
      console.log("guessedNum == undefined");
      break;
    }
    if (guessedNum == numToGuess){
      return i;
    }
    
  }
    console.log("got to return 0");
    return 0;
}