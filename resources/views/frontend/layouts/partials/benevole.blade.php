<section class="ul-contact">
	<div class="ul-container">
		<div class="row g-0">
			<div class="col-lg-5">
				<div class="ul-contact-img">
					<img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Image">
				</div>
			</div>

			<!-- form -->
			<div class="col-lg-7">
				<div class="ul-contact-form-wrapper">
					<span class="ul-section-sub-title">Agir avec nous dès maintenant</span>
					<h2 class="ul-section-title">Devenez Bénévole ou volontaire -> Devenez partenaires</h2>

					<form action="{{ route('benevole.store') }}" class="ul-contact-form" method="POST">
					@csrf
						<div class="row row-cols-2 row-cols-xxs-1 ul-bs-row">
							<div class="col">
								<div class="form-group">
									<input type="text" name="name" id="ul-contact-name" placeholder="Nom">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<input type="text" name="prenom" id="ul-contact-name" placeholder="Prénom">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<input type="email" name="email" id="ul-contact-email" placeholder="Email">
								</div>
							</div>
							<div class="col">
								<div class="form-group">
									<input type="tel" name="phone" id="ul-contact-phone" placeholder="Téléphone">
								</div>
							</div>
							
							<div class="col-12">
								<button class="ul-btn"><i class="flaticon-fast-forward-double-right-arrows-symbol"></i> Envoyer</button>
							</div>
						</div>
						@if(session('success'))
						<div class="col">
							<div class="alert alert-success">
								{{ session('success') }}
							</div>
						</div>
					@endif
					@error('name')
						<div class="col">
							<div class="alert alert-danger">
								{{ $message }}
							</div>
						</div>
					@enderror
					@error('prenom')
						<div class="col">
							<div class="alert alert-danger">
								{{ $message }}
							</div>
						</div>
					@enderror
					@error('email')
						<div class="col">
							<div class="alert alert-danger">
								{{ $message }}
							</div>
						</div>
					@enderror
					@error('phone')
						<div class="col">
							<div class="alert alert-danger">
								{{ $message }}
							</div>
						</div>
					@enderror
					</form>
				</div>
			</div>
		</div>
	</div>
</section>