Dropzone.options.uploadForm = {
  autoProcessQueue: true,
  maxFilesize: 500, // Limite de 500 MB
  parallelUploads: 100,
  maxFiles: 100,
  init: function () {
    var myDropzone = this;

    this.on("success", function (file, response) {
      var code = response.trim();
      var fileName = file.name;
      var fileList = document.getElementById("file-list");

      var fileContainer = document.createElement("div");
      fileContainer.classList.add("file-info");
      fileContainer.innerHTML = "<strong>File Sent:</strong> " + fileName;
      fileList.appendChild(fileContainer);

      var fileCodeContainer = document.createElement("div");
      fileCodeContainer.classList.add("file-code-container");
      fileCodeContainer.addEventListener("click", function () {
        copyCode(this);
      });
      fileCodeContainer.innerHTML = "<div class='file-code'>" + code + "</div>";
      fileList.appendChild(fileCodeContainer);

      var hr = document.createElement("hr");
      fileList.appendChild(hr);

      myDropzone.removeFile(file);
    });

    this.on("addedfile", function () {
      myDropzone.processQueue();
    });
  },
};

function copyCode(container) {
  var code = container.querySelector(".file-code").innerText;
  navigator.clipboard.writeText(code).then(function () {
    var notification = document.getElementById("copy-notification");
    notification.classList.add("show");
    setTimeout(function () {
      notification.classList.remove("show");
    }, 3000);
  });
}
