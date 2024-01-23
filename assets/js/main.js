// Replace this with your SunCalc library import or loading mechanism
// Here, I'm using a placeholder for the SunCalc object

// Function to convert time to decimal hours
function getTimeInDecimalHours(timeString) {
	// Parse the time string
	const timeRegex = /(\d+):(\d+) (AM|PM)/;
	const match = timeString.match(timeRegex);

	if (!match) {
		console.error("Invalid time format");
		return null;
	}

	let hours = parseInt(match[1]);
	const minutes = parseInt(match[2]);
	const period = match[3].toUpperCase();

	// Adjust hours for 12-hour clock
	if (period === "PM" && hours !== 12) {
		hours += 12;
	} else if (period === "AM" && hours === 12) {
		hours = 0;
	}

	// Calculate decimal hours
	const decimalHours = hours + minutes / 60;

	return decimalHours;
}

// Get current date
var sunrise = getTimeInDecimalHours("08:31 AM");
var sunset = getTimeInDecimalHours("05:12 PM");
var moonrise = getTimeInDecimalHours("02:19 PM");
var moonset = getTimeInDecimalHours("07:41 AM");

var points = [
	{ x: 0, y: 0 },
	{ x: sunrise, y: sunrise },
	{ x: sunset, y: sunset },
	{ x: moonrise, y: moonrise },
	{ x: moonset, y: moonset },
	{ x: 24, y: 0 },
];

console.table(points);

// Get canvas and context
var canvas = document.getElementById("sunriseSunsetChart");
var ctx = canvas.getContext("2d");

// Create the chart
var chart = new Chart(ctx, {
	type: "line",
	data: {
		labels: Array.from({ length: 6 }, (_, i) => i),
		datasets: [
			{
				label: "Sunrise Sunset Times",
				data: points,
				backgroundColor: "transparent",
				borderColor: "orange",
				borderWidth: 2,
				tension: 0.4, // Adjust tension for smoother curve
			},
		],
	},
	options: {
		scales: {
			y: {
				// beginAtZero: true,
				max: 24,
				title: {
					display: true,
					text: "Time (minutes past midnight)",
				},
			},
		},
	},
});
