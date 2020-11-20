import requests
from bs4 import BeautifulSoup


def get_last_page(url):
    result = requests.get(url)
    soup = BeautifulSoup(result.text, "html.parser")
    pagination = soup.find("div", {"class": "s-pagination"})
    if pagination is None:
        last_page = "1"
    else:
        pages = pagination.find_all("a")
        last_page = pages[-2].get_text(strip=True)
    return int(last_page)


def extract_jobs(url, last_page):
    jobs = []
    for page in range(last_page):
        print(f"Scrapping so page {page}")
        result = requests.get(f"{url}&pg={page+1}")
        soup = BeautifulSoup(result.text, "html.parser")
        results = soup.find_all("div", {"class": "-job"})
        for result in results:
            job = extract_job(result)
            jobs.append(job)
    return jobs


def extract_job(html):
    title = html.find("h2").find("a")["title"]
    h3 = html.find("h3")
    company = h3.find("span").get_text(strip=True)
    location = h3.find("span", {"class": "fc-black-500"})
    job_id = html["data-jobid"]

    if location is not None:
        location = location.get_text(strip=True)
    else:
        location = None

    return {
        "title": title,
        "company": company,
        "location": location,
        "apply_link": f"https://stackoverflow.com/jobs/{job_id}"
    }


def get_jobs(word):
    url = f"https://stackoverflow.com/jobs?q={word}&sort=i"
    last_page = get_last_page(url)
    jobs = extract_jobs(url=url, last_page=last_page)
    return jobs
