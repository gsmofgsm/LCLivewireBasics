<div
    class="w-1/2 border px-4 py-2"
    wire:ignore
    x-data
    x-init="
                    new Taggle($el, {
                        tags: {{ $tags }},
                        onTagAdd: function(e, tag) {
                            livewire.emit('tagAdded', tag);
                        },
                        onTagRemove: function(e, tag) {
                            livewire.emit('tagRemoved', tag);
                        }
                    })
                "
>
</div>
