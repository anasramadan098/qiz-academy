

// Count All Indexex
// const lastIndex = steps.length - 1;
let currentIndex = 0;
document.querySelector('.hidden').value = currentIndex;

// Get All Btns
const btnNext = document.querySelectorAll('.next');
// const btnsBack = document.querySelectorAll('.back');

const startBtn = document.querySelector('.start');
const examDuration = document.querySelector('.exam-duration');

const id = location.pathname.match(/-?\d+(\.\d+)?/g)[0];
let timeOut = 1000;

startBtn.addEventListener('click', function() {
    // Start the exam timer
    let totalSeconds = 60 * 60; // 60 minutes * 60 seconds per minute
    let minutes = 60;
    let seconds = 0;
  
    setTimeout(() => {
        const timerInterval = setInterval(() => {
            seconds--;
            if (seconds < 0) {
              seconds = 59;
              minutes--;
            }
        
            // Update the timer display
            examDuration.innerHTML = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
      
            if (minutes < 10) {
              examDuration.classList.add('red');
            }
      
        
            // Check if the timer has reached zero
            if (minutes === 0 && seconds === 0) {
              clearInterval(timerInterval);
                  // Handle exam completion (e.g., display a message, submit the exam)
                  alert("Exam time is up!");
      

                  const url = `/certiication?t=l&id=${id}`;
          
                  location.href = url;
            }

            if (document.querySelector(`.final-step .my-degree`).innerHTML != '') {
                clearInterval(timerInterval);
            }

          }, 1000); 

        //   const steps = document.querySelectorAll('.step');

        //   steps.forEach( step => {
        //     step.classList.remove('active');
        //     });
        // steps[currentIndex + 1].classList.add('active');

    }, timeOut);

    
});

// btnsBack.forEach(btn => {
//     btn.addEventListener('click', () => {
//         if ( currentIndex != 0) {
//             currentIndex = currentIndex - 1;
//         }
//         steps.forEach( step => {
//             step.classList.remove('active');
//         })
//         steps[currentIndex].classList.add('active');

//     })
// })


// Prevent contextmenu
document.addEventListener('contextmenu', event => event.preventDefault());

// Prevent Opeen Inspect
document.addEventListener('keydown', event => {
    console.log(event);
    if (event.key === 'F12') {
        event.preventDefault();
    }
    // Prevent Open With Shortcut shift+ctrl+i
    if (event.shiftKey && event.ctrlKey && event.key === 'I') {
        event.preventDefault();
    }
});





// Create Step Dom With Js 
function createStep(index,question,answers) {
    const step = document.createElement('div');
    step.classList.add('step');
    
    const h3 = document.createElement('h3');
    h3.textContent = question;
    
    step.appendChild(h3);

    const inputsDiv = document.createElement('div');
    inputsDiv.className = 'inputs';


    answers.forEach((answer,i) => {
        const inputDiv = document.createElement('div');
        inputDiv.className = 'input';

        const input = document.createElement('input');
        input.type = 'radio';
        input.name = `question_${index}`;
        input.required = true;

        input.id = `question_${index}_answer_${i}`;
        input.value = answer;


        const label = document.createElement('label');
        label.htmlFor = `question_${index}_answer_${i}`;
        label.textContent = answer;

        inputDiv.appendChild(input);
        inputDiv.appendChild(label);

        inputsDiv.appendChild(inputDiv);

    })

    step.appendChild(inputsDiv);

    // Create btns
    const btns = document.createElement('div');
    btns.className = 'btns';
    const p = document.createElement('p');
    p.className = `p-${index}`;
    btns.appendChild(p);

    const btn = document.createElement('button');
    btn.className = 'btn next';
    btn.textContent = 'Submit';

    btns.appendChild(btn);


    step.appendChild(btns);

    document.querySelector('.steps').appendChild(step);
    
}

function nextStep() {

    setTimeout(() => {
       // Get All The Steps
        const steps = document.querySelectorAll('.step');

        steps.forEach( step => {
            step.classList.remove('active');
        })
        steps[currentIndex + 1].classList.add('active');
        currentIndex++; 
        document.querySelector('.hidden').value = currentIndex;
    }, 1000);
}

function check() {
    
}