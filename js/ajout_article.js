let fileInput = document.getElementById("file-input");
let imageContainer = document.getElementById("images");
let numOfFiles = document.getElementById("num-of-files");

function preview(){

      // Vérifier si le nombre d'images sélectionnées dépasse 3
      if (fileInput.files.length > 3) {
        alert("Vous ne pouvez sélectionner que 3 images maximum.");
        // Réinitialiser l'élément d'entrée de fichier
        fileInput.value = "";
        return;
    }
    imageContainer.innerHTML = "";
    numOfFiles.textContent = `${fileInput.files.length} photos séléctionnées`;

    for(i of fileInput.files){
        let reader = new FileReader();
        let figure = document.createElement("figure");
        let figCap = document.createElement("figcaption");
        figCap.innerText = i.name;
        figure.appendChild(figCap);
        reader.onload=()=>{
            let img = document.createElement("img");
            img.setAttribute("src",reader.result);
            figure.insertBefore(img,figCap);
        }
        imageContainer.appendChild(figure);
        reader.readAsDataURL(i);
    }
}

