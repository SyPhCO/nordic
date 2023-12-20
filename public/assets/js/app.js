
const sr = ScrollReveal({
  duration: 1000,
  reset: true
});

sr.reveal('h1', {
  origin: 'top',
  scale: 0.2,
});

sr.reveal('.row', {
  origin: 'top',
  scale: 0.2,
});
sr.reveal('.gallery img', {
  origin: 'top',
  scale: 0.2,
});

// memo start
const cards = document.querySelectorAll(".cardGame")

function shuffleCards(){
  cards.forEach(card => {
    const randomPos = Math.trunc(Math.random()*12)
    card.style.order = randomPos;
  })

}
shuffleCards()

cards.forEach(card => card.addEventListener("click", flipACard))

let lockedCards = false;
let cardsPicked = []



function flipACard(e){
if(lockedCards) return;
 saveCard(e.target.children[0], e.target.getAttribute("data-attr"))

 if(cardsPicked.length === 2) result();
}

function saveCard(el, value){

  if(el === cardsPicked[0]?.el) return;

  el.classList.add("activeGame");
  cardsPicked.push({el,value})
  console.log(cardsPicked);
}

function result(){
  saveNumberOfTries();
  if(cardsPicked[0].value === cardsPicked[1].value){
    cardsPicked[0].el.parentElement.removeEventListener("click", flipACard)
    cardsPicked[1].el.parentElement.removeEventListener("click", flipACard)
    cardsPicked = [];
    return;
  }

  lockedCards = true;
  setTimeout(() => {
    cardsPicked[0].el.classList.remove("activeGame");
    cardsPicked[1].el.classList.remove("activeGame");
    cardsPicked = [];
    lockedCards = false;
  }, 1000)
}

const innerCards = [ ...document.querySelectorAll(".double-face")];
const advice = document.querySelector(".advice");
const score = document.querySelector(".score");

let numberOfTries = 0;
function saveNumberOfTries(){
numberOfTries++;
const checkForEnd = innerCards.filter(card => !card.classList.contains("activeGame"))
if(!checkForEnd.length){
  advice.textContent = `Bravo ! Appuyer sur "espace" pour relancer une partie.`
  score.textContent = `Votre score final : ${numberOfTries}`
  return;
}
score.textContent = `Nombre de coups ${numberOfTries}`
}

const restartButton = document.querySelector(".restart");

        restartButton.addEventListener("click", handleRestart);

        // Fonction pour redémarrer le jeu
        function restartMemo() {
            innerCards.forEach(card => card.classList.remove("activeGame"));
            advice.textContent = "Tentez de gagner avec le moins d'essais possible.";
            score.textContent = "Nombre de coups : 0";
            numberOfTries = 0;
            cards.forEach(card => card.addEventListener("click", flipACard));

            if (shuffleLock) return;
            shuffleLock = true;

            setTimeout(() => {
                shuffleCards();
                shuffleLock = false;
            }, 600);
        }
// window.addEventListener("keydown", handleRestart)    remplacer par un button restart

let shuffleLock = false;
function handleRestart(e) {
  e.preventDefault()
  if(e.keyCode === 32){
    innerCards.forEach(card => card.classList.remove("activeGame"))
    advice.textContent = "Tentez de gagner avec le moins d'essais possible."
    score.textContent = `Nombre de coups : 0`
    numberOfTries = 0;
    cards.forEach(card => card.addEventListener("click",flipACard))
if(shuffleLock) return;
shuffleLock = true;
    setTimeout(() => {
     shuffleCards()
     shuffleLock = false; 
    }, 600)
    
  }
}
// memo end
// quiz start
const responses  = ["a", "b", "a", "c", "c"];

const form = document.querySelector(".quiz-form");
form.addEventListener("submit", handleSubmit)

function handleSubmit(e){
  e.preventDefault()

  const results = [];

  const radioButtons = document.querySelectorAll("input[type='radio']:checked");

  radioButtons.forEach((radioButton, index) => {
    if(radioButton.value === responses[index]) {
      results.push(true)
    } else {
      results.push(false)
    }
  })

  showResults(results);
  addColors(results);
}

const titleResult = document.querySelector(".results h2")
const markResult = document.querySelector(".mark")
const helpResult = document.querySelector(".help")
function showResults(results){

const errorsNumber = results.filter(el => el === false).length;
console.log(errorsNumber) 
switch(errorsNumber) {
  case 0:
    titleResult.textContent = "Bravo c'est un sans faute !";
    helpResult.style.display = "block";
    helpResult.textContent = "Quelle culture !";
    markResult.style.display = "block";
    markResult.innerHTML = "Score : <span>5 / 5</span>";
    break;
  case 1:
    titleResult.textContent = "Vous y êtes presque !";
    helpResult.style.display = "block";
    helpResult.textContent = "Rententez une autre réponse dans la case rouge, puis re-validez !";
    markResult.style.display = "block";
    markResult.innerHTML = "Score : <span>4 / 5</span>";
    break;
  case 2:
    titleResult.textContent = "Encore un effort !";
    helpResult.style.display = "block";
    helpResult.textContent = "Rententez une autre réponse dans les cases rouge, puis re-validez !";
    markResult.style.display = "block";
    markResult.innerHTML = "Score : <span>3 / 5</span>";
    break;
  case 3:
    titleResult.textContent = "Il reste quelques erreurs.";
    helpResult.style.display = "block";
    helpResult.textContent = "Rententez une autre réponse dans les cases rouge, puis re-validez !";
    markResult.style.display = "block";
    markResult.innerHTML = "Score : <span>2 / 5</span>";
    break;
  case 4:
    titleResult.textContent = "C'est un bon début.";
    helpResult.style.display = "block";
    helpResult.textContent = "Rententez une autre réponse dans les cases rouge, puis re-validez !";
    markResult.style.display = "block";
    markResult.innerHTML = "Score : <span>5 / 5</span>";
    break;
  case 5:
    titleResult.textContent = "Courage, la prochaine fois sera la bonne.";
    helpResult.style.display = "block";
    helpResult.textContent = "Rententez une autre réponse dans les cases rouge, puis re-validez !";
    markResult.style.display = "block";
    markResult.innerHTML = "Score : <span>0 / 5</span>";
    break;

    default: 
    titleResult.textContent = "Etrange , voici un cas innatendu.Retentez votre chance."
}

}

const questions = document.querySelectorAll(".question-block");

function addColors(results){
  results.forEach((response, index) => {
    if(results[index]) {
      questions[index].style.backgroundImage = "linear-gradient(to right, #a8ff78, #78ffd6)"
    } else {
      questions[index].style.backgroundImage = "linear-gradient(to right, #f5567b, #fd674c)"
    }
  })
}

const radioInputs = document.querySelectorAll("input[type='radio']")

radioInputs.forEach(radioInput => radioInput.addEventListener('input', resetColor))

function resetColor(e) {
  console.log(e.target.getAttribute("name"))
  const index = e.target.getAttribute("name").slice(1) - 1;
  const parentQuestionBlock = questions[index];

  parentQuestionBlock.style.backgroundColor = "#f1f1f1";
  parentQuestionBlock.style.backgroundImage = "none";
}
// quiz end
