'use strict';
const transformNumber = (number) => {
    return number.replace("(", "").replace(")","-");
};

const validateForm = (event) => {
    event.preventDefault();
    showResults(false);
    // HTML validation using the regex patterns indicated in HTML. Same thing as independently checking for them.
    // Would have just used regex matching here, but why reinvent the wheel.
    // Ideally sanitize address input as well if there was a backend.
    const form = document.getElementById("infoForm");
    form.reportValidity();
    const valid = form.checkValidity();
    if (valid) {
        const values = form.getElementsByTagName("input");
        const info = {};
        for (const input of values) {
            const {id, value } = input;
            info[id] = id === "phone" ? transformNumber(value).trim() : value.trim();
            input.value = ""; // clear inputs
        }
        generateResults(info);
    }
}

const generateResults = (info) => {
    const resultsBody = document.getElementById("resultsBody");
    resultsBody.innerHTML = "";
    resultsBody.innerHTML += '<h3 class="title">User Information</h3>';
    for (const pair in info) {
        resultsBody.innerHTML += `<h4 class="col-lg-6">${pair.charAt(0).toUpperCase()}${pair.slice(1)}:</h4>`;
        resultsBody.innerHTML += `<h5 class="col-lg-6">${info[pair]}</h5>`;
    }
    showResults();
}

const showResults = (show = true) => {
    const results = document.getElementById('results');
    show ? results.classList.remove("hidden") : results.classList.add("hidden");
}

// Problem 2 Code

const countChars = () => {
    const textArea = document.getElementById("area51");
    document.getElementById("chars").innerText = textArea.value.length;
    document.getElementById("letters").innerText = countLetters(textArea.value);
}

const countLetters = (string) => {
    let numLetters = 0;
    const results = string.matchAll(new RegExp('[a-zA-Z]', "g"));
    for (const _ of results) {
        numLetters += 1;
    }
    return numLetters
}

// Problem 3 Code

const generateBookmark = (name, url) => {
    const secureLink = url.startsWith("https");
    const bookmark = `<li>
    <a class="card inner-card" href="${url}">
        <h4 class="card-body">${name} - ${url}  <img src="./assets/${secureLink ? 'lock' : 'unlock'}.svg"></h4>
        <button style="z-index: 9999;" onclick="deleteBookmark(event,'${url}')" class="btn btn-danger">Remove</button>
    </a>
</li>`;
    return bookmark;
}

// In the format of url: bookmark elements
document.userBookmarks = {
    "https://cs.torontomu.ca/~mnismail/cps530/lab4/lab04.html": generateBookmark("This Atrocity", "https://cs.torontomu.ca/~mnismail/cps530/lab4/lab04.html"),
    "https://www.google.ca/" : generateBookmark("Google", "https://www.google.ca/"),
    "http://httpforever.com/": generateBookmark("HTTP Forever", "http://httpforever.com/")
}

const addBookmark = (id, bookmark) => {
    document.userBookmarks[id] = bookmark;
    renderBookmarks();
}

const deleteBookmark = (event, id, userTriggered = true) => {
    event.preventDefault();
    if (userTriggered) {
        const proceed = confirm("Confirm bookmark removal");
        if (!proceed) return false;
    }
    const { [id]: _ , ...rest } = document.userBookmarks;
    document.userBookmarks = rest;
    renderBookmarks();
}

const populateDefaultBookmarks = () => {
    renderBookmarks();
}

const renderBookmarks = () => {
    // clear bookmarks
    const list = document.getElementById("bookmarkList");
    list.innerHTML = " ";
    for (const bm in document.userBookmarks) {
        list.innerHTML += document.userBookmarks[bm];
    }   
}


const addCustomBookmark = (event) => {
    event.preventDefault();
    const form = document.getElementById("bookmarkForm");
    form.reportValidity();
    const valid = form.checkValidity();
    if (valid) {
        const url = document.getElementById('url');
        const normalizedUrl = url.value.trim();
        const name = document.getElementById('bk-name');
        if (normalizedUrl in document.userBookmarks) {
            alert("Bookmark already exists for this URL. Try another website");
        } else {
            const generatedBM = generateBookmark(name.value.trim(), normalizedUrl);
            document.userBookmarks[normalizedUrl] = generatedBM;
            renderBookmarks();
        }
        url.value = "";
        name.value = "";
    }
}