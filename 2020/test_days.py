from days import partOne, partTwo, is2020

def test_part_one():
  assert partOne([1721, 979, 366, 299, 675, 1456]) == 514579

def test_part_one_with_string():
  assert partOne(["1721", "979", "366", "299", "675", "1456"]) == 514579

def test_part_two():
  assert partTwo([1721, 979, 366, 299, 675, 1456]) == 241861950

def test_part_two_with_string():
  assert partTwo(["1721", "979", "366", "299", "675", "1456"]) == 241861950

def test_is2020():
  assert is2020(1721, 979) == False
  assert is2020(1721, 299) == True
  assert is2020(1721, 979, 366) == False
  assert is2020(979, 366, 675) == True
