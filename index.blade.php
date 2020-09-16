@extends('layouts.app')

@section('htmlheadassets')
	<style>
		.grid {
			display: grid;
			grid-gap: 5px;
			grid-template-columns: repeat(auto-fill, minmax(240px,1fr));
			grid-auto-rows: 0px;
		}

		.desc {
			padding: 5px 5px 5px 5px;
		}

		.desc b {
			margin-bottom: 5px;
		}
	</style>
@endsection

@section('content')
	<div class="col-12 text-right">
		<a href='{{ url("rigasvilni/test/store") }}' class="btn btn-info">
			<i class="fas fa-plus-circle"></i>
			Pievienojiet ierakstu
		</a>
	</div>
	<hr/>
	<div class="grid" id="block"></div>
@endsection

@section('htmlbodyassets')
	<script src="//code.jquery.com/mobile/1.5.0-alpha.1/jquery.mobile-1.5.0-alpha.1.min.js"></script>
	<script>
		$(window).on("orientationchange", function(event) {
			if (event.orientation == 'landscape') {
				var url = '/rigasvilni/test/json/landscape';
			} else {
				var url = '/rigasvilni/test/json/portrait';
			}
			getData(url);
		});

		$(window).orientationchange();
		
		function getData(url) {
			$.getJSON (
				url,
				function(result) {
					var data = '';
					if (result) {
						$.each(result, function(index, value) {
							data += '<div class="item">';
							data += '<div class="content">';
							data += '<div class="desc d-flex" style="background: '+value.color+'; height: '+value.height+'px">';
							data += '<b class="text-white d-flex w-100 justify-content-center align-self-center">'+value.number+'</b>';
							data += '</div>';
							data += '</div>';
							data += '</div>';
						});
						$('#block').html(data);

						function resizeGridItem(item) {
							grid = $(".grid")[0];
							rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
							rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
							rowSpan = Math.ceil((item.querySelector('.content').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));
							item.style.gridRowEnd = "span "+rowSpan;
						}

						function resizeAllGridItems() {
							allItems = $(".item");
							for(number = 0; number < allItems.length; number++) {
								resizeGridItem(allItems[number]);
							}
						}

						window.onload = resizeAllGridItems();
						window.addEventListener("resize", resizeAllGridItems);
						$(".ui-loader-header").hide();
					}
				}
			);
		}
	</script>
@endsection
