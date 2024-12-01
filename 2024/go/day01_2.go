package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func main() {
	file, err := os.Open("inputs/day01.txt")
	if err != nil {
		fmt.Println("couldn't read the file")
	}
	leftGroup := []int{}
	rightGroup := []int{}
	sum := []int{}

	scanner := bufio.NewScanner(file)
	for scanner.Scan() {
		line := scanner.Text()

		splitString := strings.Split(line, " ")

		leftNumber, _ := strconv.Atoi(splitString[0])
		leftGroup = append(leftGroup, leftNumber)

		rightNumber, _ := strconv.Atoi(splitString[3])
		rightGroup = append(rightGroup, rightNumber)
	}

	for _, leftNumber := range leftGroup {
		count := 0
		for _, rightNumber := range rightGroup {
			if leftNumber == rightNumber {
				count++
			}
		}
		if count > 0 {
			sum = append(sum, leftNumber*count)
		}
	}

	sumOfArray(sum)
}

func sumOfArray(sum []int) {
	result := 0

	for i := 0; i < len(sum); i++ {
		result += sum[i]
	}
	println(result)
}
