<!DOCTYPE html>
<html lang="en">
<head>
	@include('admin::parts.head')

<body>
<div id="full-container">
	@include('admin::parts.menu')

	<div id="page-info">
		<div class="container">
			<h1>Dashboard</h1>
		</div>
	</div>

	<div id="dashboard-container" class="container">
        <ul id="breadcrumbs"></ul>
    </div>

    @include('admin::parts.footer')
    <!--@include('admin::parts.footer')-->

</div>
</body>
</html>