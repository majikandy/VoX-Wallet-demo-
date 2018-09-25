@extends('layouts.app')
@section('content')
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

        <section id="content">
            <div class="well">
              <h3>Search for a user you want to send to</h3>
              <br>
              <input type="search" id="search" value="" class="form-control" placeholder=" Search for user">
            </div>
            <div id="users-list" class="well hidden">
  
                <div id="no-users-found" class="hidden">
                    <td>
                        no-users-found
                    </td>
                  </div>

              <table class="table" id="table">
                <br>
                  <tbody>
                    
                    @foreach($users->where('id', '!=', Auth::user()->id) as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><button class="btn btn-primary" data-toggle="modal" data-target="#{{ $loop->iteration }}">View profile</button></td>
                    </tr>
                   

                    <!-- Modal -->
                    <div class="modal fade" id="{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="{{ $loop->iteration }}" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body" style="text-align:center">
                            <p style="font-size:24px">{{ $user->name }}</p>
                            <p>{{ $user->email }}</p>

                            <form action="/send" method="POST" id="{{ $user->name }}">
                              {{ csrf_field() }}
                              <div class="form-group">
                                <input type="hidden" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                <input type="hidden" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $user->id }}">
                                <label for="amount">Amount</label>
                                <input type="number" step="0.01" class="form-control" size="20" id="amount" name="amount" dusk="amount{{ $user->id }}" placeholder="10" value="5" required min="5" max="{{ (Auth::user()->transactions->where('CreditOrDebit', 'Credit')->sum('amount')) - (Auth::user()->transactions->where('CreditOrDebit', 'Debit')->sum('amount')) }}">
                              </div>
                              <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach

                  </tbody>
              </table>
            </div>
        </div>

        <script>
          $(document).ready(function(){
            $("#search").on("keyup", function() {
               var value = $(this).val().toLowerCase();
               if ($(this).val().length !== 0) {
                 $("#users-list").removeClass("hidden");
                 $("#no-users-found").addClass("hidden");
               }
               else {
                 $("#users-list").addClass("hidden");
               }

              $("#table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) >= 0);
              });
            });
          });
        </script>
      </section>
@endsection
