window.onload = function() {

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "En Çok Satın Alınan Ürünler",
            horizontalAlign: "center"
        },
        data: [{
            type: "doughnut",
            startAngle: 60,
            //innerRadius: 60,
            indexLabelFontSize: 17,
            indexLabel: "{label} - #percent%",
            toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            dataPoints: [
                { y: 15, label: "Playstation" },
                { y: 7, label: "Xbox" },
                { y: 90, label: "Laptop" },
                { y: 70, label: "Masaüstü Bilgisayar" },
                { y: 100, label: "Akıllı Telefon" },
                { y: 10, label: "Mac OS" }
            ]
        }]
    });
    chart.render();
    var chart = new CanvasJS.Chart("chartContainer2", {
        animationEnabled: true,
        title: {
            text: "En Az Satın Alınan Ürünler",
            horizontalAlign: "center"
        },
        data: [{
            type: "doughnut",
            startAngle: 60,
            //innerRadius: 60,
            indexLabelFontSize: 17,
            indexLabel: "{label} - #percent%",
            toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            dataPoints: [
                { y: 67, label: "Elma" },
                { y: 28, label: "Armut" },
                { y: 10, label: "Muz" },
                { y: 7, label: "Şeftali" },
                { y: 15, label: "Kiraz" },
                { y: 6, label: "Karpuz" }
            ]
        }]
    });
    chart.render();
    var chart = new CanvasJS.Chart("chartContainer3", {
        animationEnabled: true,
        title: {
            text: "En Fazla Tıklanan Ürünler",
            horizontalAlign: "center"
        },
        data: [{
            type: "doughnut",
            startAngle: 60,
            //innerRadius: 60,
            indexLabelFontSize: 17,
            indexLabel: "{label} - #percent%",
            toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            dataPoints: [
                { y: 150, label: "Iphone 12 Pro" },
                { y: 125, label: "Playstation 5" },
                { y: 100, label: "Samsung S21 Ultra" },
                { y: 25, label: "MSI RTX 3090 24 GB" },
                { y: 50, label: "Ryzen 7 5800X" },
                { y: 15, label: "Xbox Series S" }
            ]
        }]
    });
    chart.render();
    var chart = new CanvasJS.Chart("chartContainer4", {
        animationEnabled: true,
        title: {
            text: "En İyi Fiyatlı Satın Alınan Ürünler",
            horizontalAlign: "center"
        },
        data: [{
            type: "doughnut",
            startAngle: 60,
            //innerRadius: 60,
            indexLabelFontSize: 17,
            indexLabel: "{label} - #percent%",
            toolTipContent: "<b>{label}:</b> {y} (#percent%)",
            dataPoints: [
                { y: 67, label: "Domates" },
                { y: 28, label: "Marul" },
                { y: 10, label: "Salatalık" },
                { y: 7, label: "Lahana" },
                { y: 15, label: "Soğan" },
                { y: 6, label: "Karnıbahar" }
            ]
        }]
    });
    chart.render();
}

function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}
/*
const toplamSiparis = document.getElementById("toplamSiparis");
animateValue(toplamSiparis, 25, 285, 1250);*/
/*
const toplamSiparis = document.getElementById("bekleyenSiparis");
animateValue(toplamSiparis, 0, 3, 1250);

const toplamSiparis = document.getElementById("iadeSiparis");
animateValue(toplamSiparis, 0, 1000, 1250);
*/