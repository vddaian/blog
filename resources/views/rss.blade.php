<?=
'<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<rss version="2.0">

    <channel>
        <title>
            blogMor.com 
        </title>
        <link>
        {{ route('posts.index') }} 
        </link>
        <language>en-E</language>
        <pubDate>{{ now() }}</pubDate>
        @foreach ($data->original['data'] as $item)
            <item>
                <title>
                   {{ $item['title'] }}
                </title>
                <link>{{ route('posts.show', $item['id']) }}</link>
                <content>
                    @auth
                   {!! substr(nl2br(e($item['content'])), 0, 400)!!}
                    @else
                   {!! substr(nl2br(e($item['content'])), 0, 150)!!}
                    @endauth
                </content>
                <author>
                   {{$item['author']}}
                </author>
                <guid>{{ $item['id'] }}</guid>
                <pubDate>{{ $item['created_at']->toRssString() }}</pubDate>
            </item>
         @endforeach
    </channel>
</rss>