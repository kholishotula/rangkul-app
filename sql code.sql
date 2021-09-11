insert into public.users values (1, 'Maya', 'email@gmail.com', 'xwkbgdiyw', current_timestamp, current_timestamp);

insert into public.donasis values (1, 'Bantu Maya untuk sekolah', 'Maya seorang anak yang peru dibantu dalam keperluan sekolah', 'Buku', 'SD', current_date, '2021-09-30', 1000000, 0, 'ongoing', null, 'BRI', '1376462', current_timestamp, current_timestamp);
insert into public.donasis values (2, 'Aku ingin sekolah, tapi tidak punya buku', 'Diperlukan bantuan untuk dirupakan dalam bentuk buku', 'Buku', 'SMP', current_date, '2021-09-25', 500000, 0, 'ongoing', null, 'OVO', '562698', current_timestamp, current_timestamp);
insert into public.donasis values (3, 'Malu tidak punya seragam', 'Bantu Amaliah untuk bersekolah dengan menggunakan seragam', 'Seragam', 'SD', current_date, '2021-09-21', 200000, 0, 'ongoing', null, 'BCA', '526218944', current_timestamp, current_timestamp);
insert into public.donasis values (4, '7 tahun belum lulus karena tidak ada biaya', 'Orang ini tidak diluluskan oleh perguruan tingginya karena UKT yang belum lunas', 'Biaya pendidikan', 'Perguruan Tinggi', current_date, '2021-10-25', 10000000, 0, 'ongoing', null, 'Mandiri', '94984119', current_timestamp, current_timestamp);
insert into public.donasis values (5, 'Harus bergantian 7 saudara untuk sekolah', 'Di masa pandemi perlu HP untuk mengikuti pembelajaran daring', 'Lainnya', 'SMA', current_date, '2021-09-21', 3000000, 0, 'ongoing', null, 'BRI', '1215642', current_timestamp, current_timestamp);
insert into public.donasis values (6, 'Menyusuri hutan demi mencari sinyal', 'Bantuan ini ditujukan untuk membuat tower operator di daerah zuzu', 'Lainnya', 'Lainnya', current_date, '2021-12-31', 200000000, 0, 'ongoing', null, 'BNI', '98289456418', current_timestamp, current_timestamp);

INSERT INTO public.user_donasis VALUES (1, 1, 1, 50000, CURRENT_TIMESTAMP, 'BRI', current_timestamp, current_timestamp);
INSERT INTO public.user_donasis VALUES (2, 1, 1, 100000, CURRENT_TIMESTAMP, 'OVO', current_timestamp, current_timestamp);

-- trigger - donasi (if user donate, change the jumlah_kini)
CREATE OR REPLACE FUNCTION f_update_from_donation()
	RETURNS trigger AS $$
BEGIN
	IF pg_trigger_depth() <> 1 THEN
        RETURN NEW;
    END IF;

	UPDATE public.donasis
	SET jumlah_kini = jumlah_kini + NEW.nominal
	WHERE id = NEW."donasiId";

	RETURN NEW;
END; $$
LANGUAGE plpgsql; 

DROP TRIGGER IF EXISTS update_from_donation 
ON public.user_donasis;

CREATE TRIGGER update_from_donation
  	AFTER INSERT
  	ON public.user_donasis
  	FOR EACH ROW
  	EXECUTE PROCEDURE f_update_from_donation();

