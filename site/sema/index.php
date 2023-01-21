<?php
require_once 'logic1.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ComLin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<div class="container">
  <header class="blog-header py-3">
    <h3><em><p class="text-center">Новости</p></em></h3>
  </header>
    <main>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="novost-tab" data-bs-toggle="tab" data-bs-target="#novost" type="button" role="tab" aria-controls="novost" aria-selected="true">Новости</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="analis-tab" data-bs-toggle="tab" data-bs-target="#analis" type="button" role="tab" aria-controls="analis" aria-selected="false">Анализ новостей</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="tonal-tab" data-bs-toggle="tab" data-bs-target="#tonal" type="button" role="tab" aria-controls="tonal" aria-selected="false">Тональность новостей</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
 <!-------------------------------------1 страница----------------------------------------->            
          <div class="tab-pane fade show active" id="novost" role="tabpanel" aria-labelledby="novost-tab">
          <table class="table table-success table-striped">
          
                <thead>
                  <tr>
                    <th scope="col">Название статьи</th>
                    <th scope="col">Содержание</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Ссылка</th>
                    
                  </tr>
                </thead>
                <tbody>
                  
                <?php foreach ($bd_novosts as $item): ?>
    
                    <tr>
                      
                          <td><?php echo $item['title']?></td>
                          <td><?php echo $item['text']?></td>
                          <td><?php echo $item['date']?></td>
                          <td><a href="<?php echo $item['url']?>"><?php echo $item['url']?></a></td>
                    </tr>
                  <?php endforeach; ?>       
                </tbody>
              </table>
            
          </div>

 <!-------------------------------------2 страница----------------------------------------->
          <div class="tab-pane fade" id="analis" role="tabpanel" aria-labelledby="analis-tab">
          <div class="container text-center">
              
              <div class="row justify-content-around">
                <div class="col-4">
                <table class="table table-success table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Персона</th>
                        <th scope="col">Предложение</th>
                        <th scope="col">Ссылка</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($bd_nametosents as $item): ?>
                        <tr>
                            <td><?php echo $item['names']?></td>
                            <td><?php echo $item['texts']?></td>
                            <td><a href="<?php echo $item['urls']?>"><?php echo $item['urls']?></a></td>
                        </tr>
                      <?php endforeach; ?>       
                    </tbody>
                  </table>
                </div>
                <div class="col-4">
                <table class="table table-success table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Достопримечательность</th>
                        <th scope="col">Предложение</th>
                        <th scope="col">Ссылка</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($bd_attrtosents as $item): ?>
                        <tr>
                            <td><?php echo $item['names']?></td>
                            <td><?php echo $item['texts']?></td>
                            <td><a href="<?php echo $item['urls']?>"><?php echo $item['urls']?></a></td>
                        </tr>
                      <?php endforeach; ?>       
                    </tbody>                    
                  </table>
                </div>
              </div>
              
            </div>

          </div>

 <!-------------------------------------3 страница----------------------------------------->
          <div class="tab-pane fade" id="tonal" role="tabpanel" aria-labelledby="tonal-tab">
          <table class="table table-success table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Предложение</th>
                        <th scope="col">Тональность</th>
                        <th scope="col">Ссылка</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($bd_sentencess as $item): ?>
                        <tr>
                            <td><?php echo $item['texts']?></td>
                            <td><?php echo $item['tonalitys']?></td>
                            <td><a href="<?php echo $item['urls']?>"><?php echo $item['urls']?></a></td>
                            
                        </tr>
                      <?php endforeach; ?>       
                    </tbody>
                  </table>
          </div>
        </div>
        
    </main>
 

 <!-------------------------------------Подвал----------------------------------------->
    <footer>
        
            
        
    </footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

