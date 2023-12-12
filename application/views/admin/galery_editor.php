<section class="container mt-5">
    <h1 class="mb-4"><?= $title ?></h1>
    <form action="<?= base_url('admin/galery_save') ?>" method="post" enctype="multipart/form-data">
        <?php if(isset($galery['galery_id'])): ?>
        <input type="hidden" name="id" value="<?= $galery['galery_id'] ?>">
        <?php endif ?>
        <div class="mb-3">
            <label for="image" class="form-label">Pilih gambar</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Judul Galery</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Judul Karya" value="<?= isset($galery['galery_title']) ? $galery['galery_title'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori Galery</label>
            <select name="category" id="category" class="form-select" required>
                <?php foreach($categories as $category): ?>
                <option value="<?= $category['category_id'] ?>" <?= ($category['category_id'] == @$galery['category_id']) ? 'selected' : '' ?>><?= $category['category_title'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stok saat ini</label>
            <input type="number" name="stok" id="stock" class="form-control" placeholder="Stok saat ini" value="<?= isset($galery['galery_stok']) ? $galery['galery_stok'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="Harga karya" value="<?= isset($galery['galery_price']) ? $galery['galery_price'] : '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Deskripsi Karya</label>
            <textarea name="desc" id="desc" class="form-control" placeholder="Deskripsi Karya" rows="10" required><?= isset($galery['galery_desc']) ? $galery['galery_desc'] : '' ?></textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-danger w-100">Simpan</button>
        </div>
    </form>
</section>