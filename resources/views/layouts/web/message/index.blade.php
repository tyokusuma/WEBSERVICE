@extends('layouts/web/master_admin')
@section('pageTitle', 'View Messages')
@section('content-subheader', 'List Messages')
@section('main-content')
  @include ('flash::message')
      <div class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i><a href="{{ route('view-create-inbox') }}"><span>  Add</span></a></div>
      <table id="message" class="table table-bordred table-striped">
          <thead>
                <th>No</th>
                <th>From</th>
                <th>Content</th>
                <th></th>
                <th></th>
          </thead>
          <tbody>
            <?php $i = 1; $skipped = ($messages->currentPage() * $messages->perPage()) - $messages->perPage(); ?>
            @foreach($messages as $message)
              <tr>
                  <td class="{{ $message->read_admin == '0' ? 'primary-font' : '' }}">{{ $skipped + $i }}</td>
                  <td class="{{ $message->read_admin == '0' ? 'primary-font' : '' }}">{{ $message->users->full_name }}</td>
                  <td class="{{ $message->read_admin == '0' ? 'primary-font' : '' }}">{{ $message->title }}</td>
                  <td class="{{ $message->count > 0 ? 'primary-font' : '' }}"><span class="badge label-info">{{ $message->count == 0 ? '' : $message->count }}</span></td>
                  <td>
                      <a href="{{ route('view-inbox-details', ['id_message' => $message->id, 'user_id' => $message->users->id, 'full_name' => $message->users->full_name]) }}"><button class="btn btn-primary btn-xs" type="submit" form="update{{ $message->id }}"><i class="ionicons ion-chatbubble-working" aria-hidden="true"></i></button></a>
                  </td>
                  <td>
                      <form action="{{ route('delete-inbox', ['id' => $message->id]) }}" method="POST" role="form">                      
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></button>
                      </form>
                  </td>
              </tr>

            <?php $i++; ?>
            @endforeach
          </tbody>          
      </table>
  <!-- Pagination -->
  {{ $messages->links() }}

	@include('layouts.web.partials.footer')
	
@endsection

@section('script')
<script type="text/javascript">
	
</script>
@endsection