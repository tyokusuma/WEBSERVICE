@extends('layouts/web/master_admin')
@section('pageTitle', 'View Notifications')
@section('content-subheader', 'List Notifications')
@section('main-content')
      <table class="table table-bordred table-striped">
          <thead>
                <th>No</th>
                <th>Content</th>
          </thead>
          <tbody> 
            <?php $i = 1; $skipped = ($notifs->currentPage() * $notifs->perPage()) - $notifs->perPage(); ?>
            @foreach($notifs as $notif)
              <tr>
                  <td>{{ $skipped + $i }}</td>
                  <td>{{ $notif->data['message'] }}</td>
              </tr>
              <?php $i++; ?>
            @endforeach
          </tbody>          
      </table>
  <!-- Pagination -->
  {{ $notifs->links() }}

	@include('layouts.web.partials.footer')
	
@endsection

@section('script')
<script type="text/javascript">
	
</script>
@endsection