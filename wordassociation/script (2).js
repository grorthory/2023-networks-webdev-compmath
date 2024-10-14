function getNouns(word) {
  let response = [];
  let xhr = new XMLHttpRequest();
  let url = "https://api.datamuse.com/words?rel_jja=" + word;
  xhr.open("GET", url, false);
  xhr.send();
  if (xhr.status === 200) {
    let query = JSON.parse(xhr.responseText);
    for (var i = 0; i < 3; i++) {
      response.push(query[Math.floor(Math.random() * query.length)]);
    }
  }
  return response;
}

function getAdjectives(word) {
  let response = [];
  let xhr = new XMLHttpRequest();
  let url = "https://api.datamuse.com/words?rel_jjb=" + word;
  xhr.open("GET", url, false);
  xhr.send();
  if (xhr.status === 200) {
    let query = JSON.parse(xhr.responseText);
    for (var i = 0; i < 3; i++) {
      response.push(query[Math.floor(Math.random() * query.length)]);
    }
  }
  return response;
}

let startingWord = prompt("Enter a starting noun");
document.getElementById("startingword").innerHTML += startingWord;

class TreeNode {
  constructor(value) {
    this.value = value;
    this.position = [];
    this.descendants = [];
  }
}

function setupTree(startingWord) {
  var output = [];
  var tabledata = [];
  tabledata.push([], [], [], []);
  var numQueries = 0;
  const start = new TreeNode(startingWord);
  tabledata[0].push(start.value);
  var relatedStart = getAdjectives(startingWord);
  numQueries += 1;
  for (let i = 0; i < 3; i++) {
    var step1 = new TreeNode(relatedStart[i].word);
    tabledata[1].push(step1.value);
    start.descendants.push(step1);
    var related1 = getNouns(step1.value);
    numQueries += 1;
    for (let j = 0; j < 3; j++) {
      var step2 = new TreeNode(related1[j].word);
      tabledata[2].push(step2.value);
      step1.descendants.push(step2);
      var related2 = getAdjectives(step2.value);
      numQueries += 1;
      for (let k = 0; k < 3; k++) {
        var step3 = new TreeNode(related2[k].word);
        tabledata[3].push(step3.value);
        step2.descendants.push(step3);
      }
    }
  }
  console.log("num queries: " + numQueries);

  output[0] = start;
  //get tree with setUpTree(startingWord)[0];
  output.push(tabledata);
  //get table data with setUpTree(startingWord)[1];
  return output;
}

let total_reveals = -1;

function reveal(cell) {
  total_reveals += 1;
  cell.style.backgroundColor = '#007d00';
  var nextRow = cell.closest('tr').nextElementSibling;
  if (cell.innerHTML == endingWord){
    alert("You win! Turns: " + total_reveals);
    window.location.reload();
  };
  if (nextRow) {
    var cells = nextRow.querySelectorAll('td');
    var cellFirst = cell.id.split("-")[0];
    var cellSecond = cell.id.split("-")[1];
    cells.forEach(function(below) {
      var belowFirst = below.id.split("-")[0];
      var belowSecond = below.id.split("-")[1];
      if (belowFirst == cellSecond) {
        below.style.backgroundColor = '#FFFFFF';
      }
    });
  }
}

const tree = setupTree(startingWord);
console.log(tree);

//3 cells underneath have class
//display elements with that class

var contents = "";
contents += "<tr id = 'row0'><td id = '0-1' colspan=27>" + tree[1][0][0] + "</td></tr> <tr>";
for (let i = 0; i < 3; i++) {
  contents += "<td id = '1-" + (i + 1) + "' onclick='reveal(this);' colspan=9>" + tree[1][1][i] + "</td>";
}
contents += "</tr> <tr id='row1'>";
for (let i = 0; i < 9; i++) {
  let first = Math.floor((i + 3) / 3);
  let second = (i + 1);
  contents += "<td id = '" + first + "-" + second + "' onclick='reveal(this);' colspan=3>" + tree[1][2][i] + "</td>";
}
contents += "</tr> <tr id='row2'>";
for (let i = 0; i < 27; i++) {
  let first = Math.floor((i + 3) / 3);
  let second = (i + 1);
  contents += "<td id = '" + first + "-" + second + "' onclick='reveal(this);'>" + tree[1][3][i] + "</td>";
}
contents += "</tr>";
document.getElementById("table").innerHTML += contents;

var endingWord = tree[1][3][Math.floor(Math.random() * tree[1][3].length)];
document.getElementById("endingword").innerHTML += endingWord;

reveal(document.getElementById("0-1"));