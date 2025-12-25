<?php
// Veritabanýndan haberleri çekiyoruz
$sorgu = $pdo->query("SELECT * FROM news ORDER BY id DESC");
$haberler = $sorgu->fetchAll();
?>

<div class="row">
    <div class="col-12 mb-4">
        <h2>Son Haberler</h2>
        <hr>
    </div>

    <?php if (count($haberler) > 0): ?>
        <?php foreach ($haberler as $haber): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="uploads/<?php echo htmlspecialchars($haber['image']); ?>" 
                         class="card-img-top" alt="Haber Resmi" 
                         style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($haber['title']); ?></h5>
                        <p class="card-text">
                            <?php echo substr(htmlspecialchars($haber['content']), 0, 100); ?>...
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-info">Henüz eklenmiþ bir haber bulunmuyor.</div>
        </div>
    <?php endif; ?>
</div>