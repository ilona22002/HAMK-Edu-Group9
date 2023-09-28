document.addEventListener("DOMContentLoaded", function () {
    const speedValueElement = document.getElementById("speed-value");
    const needleElement1 = document.getElementById("needle1");
    const needleElement2 = document.getElementById("needle2");

    const minSpeed = 1; 
    const maxSpeed = 5; 
    const totalDegrees = 180; 
    const degreesPerSpeed = totalDegrees / (maxSpeed - minSpeed);

    
    function updateSpeed() {
        const speed1 = 3.989897;
        const speed2 = 1.5;
        
        const rotation1 = (speed1 - minSpeed) * degreesPerSpeed - 90;
        const rotation2 = (speed2 - minSpeed) * degreesPerSpeed - 90;

        needleElement1.style.transition = 'transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55)';
        needleElement2.style.transition = 'transform 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55)';
        needleElement1.style.transform = `translateX(-50%) translateY(-50%) rotate(${rotation1}deg)`;
        needleElement2.style.transform = `translateX(-50%) translateY(-50%) rotate(${rotation2}deg)`;

        speedValueElement.textContent = `1: ${speed1} | 2: ${speed2}`;
    }

    updateSpeed();

    setInterval(updateSpeed, 3000);
});
