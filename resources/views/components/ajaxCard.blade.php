
            <?php
            if (isset($_POST['test'])) {
            
                ?>
                    @foreach ($allCards as $card)
                    <div class="col" style="border: 1px solid red">
                        @postCard(['route'=>'posts.show', 'id'=>$card->id, 'imageUrl'=>$card->image_url, 'title'=>$card->title,
                        'content'=>$card->content, 'createdAt'=>$card->created_at->diffForHumans(),
                        'comments'=>$card->comments->count()])
                        @endpostCard
                    </div>
                    @endforeach
                    <?php
            }
            ?>

