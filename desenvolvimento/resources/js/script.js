document.addEventListener("DOMContentLoaded", function () {
    const increaseButtons = document.querySelectorAll('.increase');
    const decreaseButtons = document.querySelectorAll('.decrease');
    const numberInputs = document.querySelectorAll('.number');

    increaseButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            updateValue(numberInputs[index], Number(numberInputs[index].value) + 1);
        });
    });

    decreaseButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            updateValue(numberInputs[index], Number(numberInputs[index].value) - 1);
        });
    });

    function updateValue(inputElement, newValue) {
        inputElement.value = newValue;
    }
});
