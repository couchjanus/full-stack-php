<?php
include_once VIEWS.'shared/admin/header.php';

?>
<style>

#drop-area {
  border: 2px dashed #ccc;
  border-radius: 20px;
  width: 60%;
  font-family: sans-serif;
  margin: 20px auto;
  padding: 20px;
}
#drop-area.highlight {
  border-color: purple;
}
p {
  margin-top: 0;
}
.my-form {
  margin-bottom: 10px;
}
#gallery {
  margin-top: 10px;
}
#gallery img {
  width: 150px;
  margin-bottom: 10px;
  margin-right: 10px;
  vertical-align: middle;
}
.button {
  display: inline-block;
  padding: 10px;
  background: #ccc;
  cursor: pointer;
  border-radius: 5px;
  border: 1px solid #ccc;
}
.button:hover {
  background: #d00;
  color: #fff;
}
#fileElem {
  display: none;
}
</style>
<div class="page-content">
   <div class="row">
        <div class="col-md-2">
        <?php
          include_once VIEWS.'shared/admin/_aside.php';
        ?>
        </div>
      <div class="col-md-10">
        <div class="content-box-large">
          <div class="panel-heading">
                <div class="panel-title"><?= $title;?> #<?= $product['id']?></div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="glyphicon glyphicon-refresh"></i></a>
                    <a href="#" data-rel="reload"><i class="glyphicon glyphicon-cog"></i></a>
                </div>
          </div>
          <form class="form-horizontal" role="form" method="POST" id="idForm" enctype="multipart/form-data">

            <div class="panel-body">
                <input type="hidden" name="id" id="id">
                <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Product Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="name" name="name" value="<?= $product['name']?>">
                        </div>
                </div>
                <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Product Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price"  value="<?= $product['price']?>">
                        </div>
                </div>
                <div class="form-group">
                  <label for="category" class="col-sm-2 control-label">Product Category</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="category" name="category">
                        <?php if (is_array($categories)): ?>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>"
                                    <?php if ($product['category_id'] == $category['id']) echo ' selected'; ?>>
                                    <?php echo $category['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                  </div>

                </div>
                <div class="form-group">
                        <label for="brand" class="col-sm-2 control-label">Product Brand</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="brand" name="brand"  value="<?= $product['brand']?>">
                        </div>
                </div>

                <div class="form-group" id="drop-area">

                        <div class="my-form col-sm-12">
                          <input type="file" class="form-control" id="fileElem" multiple accept="image/*" name="image" onchange="handleFiles(this.files)">
                          <label class="button" for="fileElem">Select some files</label>
                          <progress id="progress-bar" max=100 value=0></progress>
                          <div id="gallery">
                            <img src="/media/<?= $product['picture']; ?>" width="200" alt="" />
                          </div>
                        </div>
                </div>


                <div class="form-group">
                        <label class="col-sm-2 control-label" for="description">Product Description</label>
                        <div class="col-sm-10">
                            <textarea id="description" name="description" class="form-control">
                                <?= $product['description']?>
                            </textarea>
                        </div>
                </div>

                <div class="form-group">
                        <label for="is_new" class="col-sm-2 control-label">Is New</label>
                        <div class="col-sm-10">
                            <select name="is_new" class="form-control">
                                <option value="1" <?php if($product['is_new'] == 1) echo 'selected'?>>Да</option>
                                <option value="0" <?php if($product['is_new'] == 0) echo 'selected'?>>Нет</option>
                            </select>
                        </div>
                </div>
                <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <option value="1" <?php if($product['status'] == 1) echo 'selected'?>>Отображается</option>
                                <option value="0" <?php if($product['status'] == 0) echo 'selected'?>>Скрыт</option>
                            </select>
                        </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button id="save" type="submit" class="save btn btn-primary">Update Product</button>
                </div>
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

<?php
include_once VIEWS.'shared/admin/footer.php';
?>
<script>

// ************************ Drag and drop ***************** //

let dropArea = document.getElementById("drop-area");

// Prevent default drag behaviors
['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, preventDefaults, false);
});

// Highlight drop area when item is dragged over it
['dragenter', 'dragover'].forEach(eventName => {
  dropArea.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, unhighlight, false);
});

// Handle dropped files
dropArea.addEventListener('drop', handleDrop, false);

function preventDefaults (e) {
  e.preventDefault();
  e.stopPropagation();
}

function highlight(e) {
  dropArea.classList.add('highlight');
}

function unhighlight(e) {
  dropArea.classList.remove('active');
}

function handleDrop(e) {
  var dt = e.dataTransfer;
  var files = dt.files;

  handleFiles(files);
}

let uploadProgress = [];
let progressBar = document.getElementById('progress-bar');

function initializeProgress(numFiles) {
  progressBar.value = 0;
  uploadProgress = [];

  for(let i = numFiles; i > 0; i--) {
    uploadProgress.push(0);
  }

}

function updateProgress(fileNumber, percent) {
  uploadProgress[fileNumber] = percent;
  let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length;

  progressBar.value = total;
}

function handleFiles(files) {
  files = [...files];
  initializeProgress(files.length);
  files.forEach(uploadFile);

  files.forEach(previewFile);
}

function previewFile(file) {
  let reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onloadend = function() {
    let img = document.createElement('img');
    img.src = reader.result;
    document.getElementById('gallery').appendChild(img);
  }
}

function uploadFile(file, i) {
  var url = '/';
  var xhr = new XMLHttpRequest();
  var formData = new FormData();

  xhr.open('GET', url, true);
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

  // Update progress (can be used to show progress indicator)
  xhr.upload.addEventListener("progress", function(e) {
    updateProgress(i, (e.loaded * 100.0 / e.total) || 100);
  })

  xhr.addEventListener('readystatechange', function(e) {
    if (xhr.readyState == 4 && xhr.status == 200) {
      updateProgress(i, 100); // <- Add this
    }
    else if (xhr.readyState == 4 && xhr.status != 200) {
      // Error. Inform the user
    }
  })

  formData.append('upload_preset', 'ujpu6gyk');
  formData.append('file', file);
  xhr.send();
}

</script>
