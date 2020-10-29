function getRandomColor() {
    let colors = ["black", "darkblue", "darkred", "darkgreen"];
    let randomColor = Math.floor(Math.random() * colors.length);
    console.log(randomColor, colors[randomColor]);
    return colors[randomColor];
}

function changeBackground() {
   let color = getRandomColor();
   document.body.style.background = color;
}

window.addEventListener("load",function() { changeBackground() });
