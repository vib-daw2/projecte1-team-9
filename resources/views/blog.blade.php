<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blogify</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar />
    <div class="w-full min-h-screen flex justify-start flex-col items-center px-12 pt-20">
        <div class="max-w-3xl mt-4 w-full mx-auto flex flex-col justify-start items-start gap-3">
            <div class="text-5xl py-2">Post {{ $id }}</div>
            <div class="font-light text-lg py-2 border-b w-full">Lorem ipsum dolor sit amet, consectetur adipisicing.
            </div>
            <div class="flex flex-wrap items-center gap-2 justify-between w-full text-gray-600 py-2 border-b">
                <x-user-display username="lorem ipsum dolor" />
                <x-date-display timestamp="19/09/2023" />
                <x-blog-like :liked="false" :likes="5" />
            </div>
            <div class="leading-1 text-lg font-light text-justify mt-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, tenetur, explicabo, quasi reiciendis
                voluptatibus qui quas delectus dolor eos iusto modi unde neque quod assumenda pariatur maiores.
                Perferendis non unde totam ducimus est quasi harum quisquam animi impedit, voluptate dolore at aliquam
                distinctio incidunt maiores cumque sint temporibus excepturi ipsam, numquam in? Delectus, sapiente, ea
                autem est non neque, inventore error veritatis itaque animi aut voluptates vitae iste at odio eveniet
                maiores earum corrupti voluptas. Voluptas quasi exercitationem reprehenderit consectetur quia at. Magni
                ex, corporis natus dolore tempore doloribus nisi dicta cumque quod error repudiandae esse ipsa molestias
                obcaecati consequatur, impedit aspernatur eveniet, soluta sunt molestiae illo alias? Voluptatum velit
                repudiandae aperiam officiis cumque! Reprehenderit ipsum eum unde earum sit!
            </div>

        </div>
    </div>
</body>

</html>
