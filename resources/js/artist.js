import './bootstrap';
import './config';

import PATH from './config';

let	artist = document.getElementById('artist');
let artistDatalist = document.getElementById('datalist_artist');
let artistPhoto = document.getElementById('photo');

async function getArtists(value)
{
    artistDatalist.innerHTML = '';
    let response = await fetch(`${PATH}/api/artist/${value}/search`);
    let content = await response.json();

    content.forEach(function (item) {
        let element = document.createElement("option");
        element.innerHTML = item.name;
        artistDatalist.appendChild(element);
    })
}

async function getPhoto(value)
{
    let response = await fetch(`${PATH}/api/artist/${value}`);
    let content = await response.json();

    artistPhoto.value = content.photo;
    console.log(content);
}

artist.oninput = function () {
    getArtists(artist.value);
}

artist.onchange = async function () {
    await getPhoto(artist.value);
};






