var colors = ['orange-fish', 'blue-fish', 'green-fish'];
var currentColorIndex = 0;

function changeFishColor(direction) {

    var fish = document.querySelector('.fish');
    var fishColorInput = document.getElementById('fishColor');

    fish.classList.remove(colors[currentColorIndex]);

    if (direction === 'right') {
        currentColorIndex = (currentColorIndex + 1) % colors.length;
    } else if (direction === 'left') {
        currentColorIndex = (currentColorIndex - 1 + colors.length) % colors.length;
    }


    fish.classList.add(colors[currentColorIndex]);
    fishColorInput.value = colors[currentColorIndex];
}


document.querySelector('.left-arrow').addEventListener('click', function() {
    changeFishColor('left');
});

document.querySelector('.right-arrow').addEventListener('click', function() {
    changeFishColor('right');
});