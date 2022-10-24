window.onload = function () {
    document.getElementById("download")
        .addEventListener("click", () => {
            const invoice = this.document.getElementById("invoice");
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 1,
                filename: 'myfile.pdf',
                image: { type: 'jpeg', quality: 1 },
                html2canvas: { scale: 10 },
                jsPDF: { unit: "in", format: [4, 2], orientation: "landscape", precision: "12"}
            };
            html2pdf().from(invoice).set(opt).save();
        })
}