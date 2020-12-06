import day01

def test_part_one():
  assert day01.partOne([1721, 979, 366, 299, 675, 1456]) == 514579

def test_part_one_with_string():
  assert day01.partOne(["1721", "979", "366", "299", "675", "1456"]) == 514579

def test_part_two():
  assert day01.partTwo([1721, 979, 366, 299, 675, 1456]) == 241861950

def test_part_two_with_string():
  assert day01.partTwo(["1721", "979", "366", "299", "675", "1456"]) == 241861950

def test_is2020():
  assert day01.is2020(1721, 979, 366) == False
  assert day01.is2020(1721, 299) == True
  assert day01.is2020(1721, 979) == False
  assert day01.is2020(979, 366, 675) == True
