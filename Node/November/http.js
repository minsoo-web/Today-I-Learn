const request = require("request");

const url = "https://api.github.com/repos/minsoo-web/nouse/issues";
const option = {
	method: "GET",
	headers: {
		"User-Agent": "Awesome-Octocat-App"
	}
};

request(url, option, (err, res, body) => {
	if (err) {
		console.log(err);
		return;
	}
	console.log(body);
});
