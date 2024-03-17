<div class="modal fade bd-example-modal-lg" id="spj_file" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h4 class="modal-title text-center">Dasar Hukum</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <style>
                    ul,
                    #myUL {
                        list-style-type: none;
                    }

                    #myUL {
                        margin: 0;
                        padding: 0;
                    }

                    .caret {
                        cursor: pointer;
                        -webkit-user-select: none;
                        /* Safari 3.1+ */
                        -moz-user-select: none;
                        /* Firefox 2+ */
                        -ms-user-select: none;
                        /* IE 10+ */
                        user-select: none;
                    }

                    .caret::before {
                        content: "\25B6";
                        color: black;
                        display: inline-block;
                        margin-right: 6px;
                    }

                    .caret-down::before {
                        -ms-transform: rotate(90deg);
                        /* IE 9 */
                        -webkit-transform: rotate(90deg);
                        /* Safari */
                        transform: rotate(90deg);
                    }

                    .nested {
                        display: none;
                    }

                    .active {
                        display: block;
                    }
                </style>

                <body>
                    <p>Klik untuk melihat!</p>

                    <ul id="myUL">
                        <li><span class="caret"><b>Dasar Hukum</b></span>
                            <ol class="nested">
                                @foreach ($pedoman as $data)
                                    @if ($data->jenis == 'SPJ Dasar Hukum')
                                        <li>
                                            <a href="{{ asset('/pedoman/' . $data->file) }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <?= $data->nama ?>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </li>
                        <li><span class="caret"><b>Panduan SPJ</b></span>
                            <ol class="nested">
                                @foreach ($pedoman as $data)
                                    @if ($data->jenis == 'SPJ Panduan')
                                        <li>
                                            <a href="{{ asset('/pedoman/' . $data->file) }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <?= $data->nama ?>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </li>
                        <li><span class="caret"><b>Template SPJ</b></span>
                            <ol class="nested">
                                @foreach ($pedoman as $data)
                                    @if ($data->jenis == 'SPJ Template')
                                        <li>
                                            <a href="{{ asset('/pedoman/' . $data->file) }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <?= $data->nama ?>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>
                        </li>


                    </ul>

                    <script>
                        var toggler = document.getElementsByClassName("caret");
                        var i;

                        for (i = 0; i < toggler.length; i++) {
                            toggler[i].addEventListener("click", function() {
                                this.parentElement.querySelector(".nested").classList.toggle("active");
                                this.classList.toggle("caret-down");
                            });
                        }
                    </script>
            </div>
        </div>
    </div>
</div>
