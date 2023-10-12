const bar = document.getElementById("bar");
const valueText = document.getElementById("value");

function setProgress() {
    const value = Math.floor(Math.random() * 5) + 1;

    const p = 180 - ((value - 1) / 4) * 180;

    bar.style.transform = `rotate(-${p}deg)`;

    valueText.textContent = value;
}

setProgress();