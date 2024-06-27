<div class="modal fade" id="becomeMemberModal" tabindex="-1" aria-labelledby="becomeMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title custom-modal-title" id="becomeMemberModalLabel">Join us to stay updated on the latest releases via email!.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="memberForm" method="POST" action="{{route('become.a.member')}}">
                    @csrf
                    <input type="hidden" id="pageValue" name="page">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="memberName">Name</label>
                                    <input type="text" name="name" class="form-control" id="memberName" placeholder="Enter your name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="memberPhone">Phone</label>
                                    <input type="tel" name="phone" class="form-control" id="memberPhone" placeholder="Enter your Phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="memberEmail">Email</label>
                                    <input type="email" name="email" class="form-control" id="memberEmail" placeholder="Enter your email" required>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn custom-btn-bg">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- modal footer --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
