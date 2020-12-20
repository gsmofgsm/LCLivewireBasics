<div
    class="w-1/2 border px-4 py-2"
    x-data
    x-init="
                    new Taggle($el, {
                        tags: {{ $tags }},
                        onTagAdd: function(e, tag) {
                            console.log('You just added ' + tag + '');
                        },
                        onTagRemove: function(e, tag) {
                            console.log('You just removed ' + tag + '');
                        }
                    })
                "
>
</div>
