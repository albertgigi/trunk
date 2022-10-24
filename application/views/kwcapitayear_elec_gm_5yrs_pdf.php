<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Convert HTML to PDF using JavaScript by DotNetTec</title>

<!-- jQuery library -->
<script src="js/jquery.min.js"></script>

<!-- jsPDF library -->
<script src="js/jsPDF/dist/jspdf.min.js"></script>

<script>
/*
 * Generate 2 pages PDF document
 */
function generatePDF() {
	var doc = new jsPDF();
	
	doc.text(20, 20, 'Hello world!');
	doc.text(20, 30, 'This is client-side Javascript to generate a PDF.');
	
	// Add new page
	doc.addPage();
	doc.text(20, 20, 'Visit CodexWorld.com');
	
	// Save the PDF
	doc.save('document.pdf');
}

/*
 * Generate PDF document with landscape orientation
 */
function generatePDF_2() {
	
	var doc = new jsPDF({
		orientation: 'landscape'
	});
	
	doc.text(20, 20, 'Hello world!');
	doc.text(20, 30, 'This is client-side Javascript to generate a PDF.');
	
	// Add new page
	doc.addPage();
	doc.text(20, 20, 'Visit CodexWorld.com');
	
	// Save the PDF
	doc.save('document.pdf');
}

/*
 * Generate PDF document with different fonts
 */
function generatePDF_3() {
	var doc = new jsPDF();
	
	doc.text(20, 20, 'This is the default font.');
	
	doc.setFont("courier");
	doc.setFontType("normal");
	doc.text(20, 30, 'This is courier normal.');
	
	doc.setFont("times");
	doc.setFontType("italic");
	doc.text(20, 40, 'This is times italic.');
	
	doc.setFont("helvetica");
	doc.setFontType("bold");
	doc.text(20, 50, 'This is helvetica bold.');
	
	doc.setFont("courier");
	doc.setFontType("bolditalic");
	doc.text(20, 60, 'This is courier bolditalic.');
	
	// Save the PDF
	doc.save('document.pdf');
}

/*
 * Generate PDF document with different font size
 */
function generatePDF_4() {
	var doc = new jsPDF();
	
	doc.setFontSize(24);
	doc.text(20, 20, 'This is a title');
	
	doc.setFontSize(16);
	doc.text(20, 30, 'This is some normal sized text underneath.');
	
	// Save the PDF
	doc.save('document.pdf');
}

/*
 * Generate PDF document with different font color
 */
function generatePDF_5() {
	var doc = new jsPDF();
	
	doc.setTextColor(100);
	doc.text(20, 20, 'This is gray.');
	
	doc.setTextColor(150);
	doc.text(20, 30, 'This is light gray.');
	
	doc.setTextColor(255,0,0);
	doc.text(20, 40, 'This is red.');
	
	doc.setTextColor(0,255,0);
	doc.text(20, 50, 'This is green.');
	
	doc.setTextColor(0,0,255);
	doc.text(20, 60, 'This is blue.');
	
	// Save the PDF
	doc.save('document.pdf');
}

/*
 * Convert HTML content to PDF
 */
function convert_HTML_To_PDF() {
	var doc = new jsPDF();
	var elementHTML = $('#contnet').html();
	var specialElementHandlers = {
		'#elementH': function (element, renderer) {
			return true;
		}
	};
	doc.fromHTML(elementHTML, 15, 15, {
        'width': 170,
        'elementHandlers': specialElementHandlers
    });
	
	// Save the PDF
	doc.save('sample-document.pdf');
}
</script>
</head>
<body>

<button onclick="generatePDF()">Click to Generate PDF</button>
<button onclick="generatePDF_2()">Click to Generate PDF (2)</button>
<button onclick="generatePDF_3()">Click to Generate PDF (3)</button>
<button onclick="generatePDF_4()">Click to Generate PDF (4)</button>
<button onclick="generatePDF_5()">Click to Generate PDF (5)</button>

<br/><br/>
<button onclick="convert_HTML_To_PDF()">Convert HTML to PDF</button>

<!-- HTML content for PDF creation -->
<div id="contnet">
	<h1>What is Lorem Ipsum?</h1>
	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
</div>
<div id="elementH"></div>
</body>

</html>