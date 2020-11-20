from flask import Flask, render_template, request, redirect, send_file
from so import get_jobs
from export import save_to_csv

app = Flask("Supper Scrapper")
db = {}


@app.route("/")
def home():
    return render_template("index.html")


@app.route("/report")
def contact():
    word = request.args.get('word')
    if word is not None:
        word = word.lower()
    else:
        return redirect('/')

    from_db = db.get(word)

    if from_db:
        jobs = from_db
    else:
        jobs = get_jobs(word)
        db[word] = jobs

    return render_template("report.html", word=word, jobs=jobs, resultsNumber=len(jobs))


@app.route("/export")
def export():
    try:
        word = request.args.get('word')
        if not word:
            raise Exception()
        word = word.lower()
        jobs = db.get(word)
        if not jobs:
            raise Exception()
        save_to_csv(jobs)
        return send_file("jobs.csv")
    except Exception:
        return redirect("/")


app.run(host="127.0.0.1")
